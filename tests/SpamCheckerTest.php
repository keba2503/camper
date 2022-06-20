<?php

namespace App\Tests;

use App\Entity\Capitulos;
use App\SpamChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SpamCheckerTest extends TestCase
{
    public function testSpamScoreWithInvalidRequest(): void
    {
        $capitulos = new Capitulos();
                $capitulos->setNombre('');
                $context = [];
        
                $client = new MockHttpClient([new MockResponse('invalid', ['response_headers' => ['x-akismet-debug-help: Invalid key']])]);
                $checker = new SpamChecker($client, 'abcde');
        
                $this->expectException(\RuntimeException::class);
                $this->expectExceptionMessage('Unable to check for spam: invalid (Invalid key).');
                $checker->getSpamScore($capitulos, $context);
    }

     /**
     * @dataProvider getComments
     */
    public function testSpamScore(int $expectedScore, ResponseInterface $response, Capitulos $capitulos, array $context)
    {
        $client = new MockHttpClient([$response]);
        $checker = new SpamChecker($client, 'abcde');

        $score = $checker->getSpamScore($capitulos, $context);
        $this->assertSame($expectedScore, $score);
    }

    public function getComments(): iterable
    {
        $capitulos = new Capitulos();
        $capitulos->setNombre('Capitulo 2 prueba');
        $context = [];

        $response = new MockResponse('', ['response_headers' => ['x-akismet-pro-tip: discard']]);
        yield 'blatant_spam' => [2, $response, $capitulos, $context];

        $response = new MockResponse('true');
        yield 'spam' => [1, $response, $capitulos, $context];

        $response = new MockResponse('false');
        yield 'ham' => [0, $response, $capitulos, $context];
    }
}
