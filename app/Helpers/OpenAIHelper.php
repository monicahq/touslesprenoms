<?php

namespace App\Helpers;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIHelper
{
    public static function getOrigin(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
Pour le prénom donné par l'utilisateur, donnez son étymologie détaillée. Expliquez plus en détail l'origine et l'évolution du prénom au fil du temps, en citant si possible des exemples anciens ou des racines linguistiques. Ajoutez des anecdotes si tu en connais
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getPersonality(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
Pour le prénom donné par l'utilisateur, indiquez quels sont les traits de personnalité du prénom. A la fin de ton message, ne mets pas d'avertissements ou de rappels. Ne liste pas les traits de personnalité dans une liste, mais en faisant des phrases et potentiellement des paragraphes. Pour chaque trait de caractère, ajoute du contexte et des exemples.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getCountryOfOrigin(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
en un seul mot et sans le point à la fin, quel est le pays d'origine du prenom donné par l'utilisateur ?
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getCelebrities(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
Quels sont les célébrités portant le prénom donné par l'utilisateur ? Ajoute leur date de naissance et, s'ils sont décédés, leur date de décès et leur âge associé, ainsi que leur métier ou pourquoi ils sont connus. Donne les réponses sous forme de liste sans aucun autre texte avant ou après. Enlève l'avertissement à la fin ou toute information indiquant que les informations peuvent varier selon les sources.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getElficTraits(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
pour le prénom donné par l'utilisateur, invente un ou plusieurs traits de personnalité elfique autour du prénom.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getLitterairesReferences(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
pour le prénom donné par l'utilisateur, donne des références littéraires ou artistiques pour le prénom. si un prénom se répète sur plusieurs langues, ne mettre qu'une itération du prénom.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getSimilarNames(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
pour le prénom donné par l'utilisateur, donne des noms similaires dans d'autres langues
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ]],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getKlingonName(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
pour le prénom donné par l'utilisateur, donne l'équivalent du prénom en langage Klingon, la langue de Star Trek. Ne mets que le prénom et rien d'autre. Si le prénom n'existe pas, écris "traduction impossible", et rien d'autre.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }

    public static function getUnisex(string $name): ?string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
pour le prénom donné par l'utilisateur, indiquez si le prénom est unisexe. répondez uniquement par "oui" ou "non", sans rien d'autres, et sans les guillements bien sur.
PROMPT,
                ], [
                    'role' => 'user',
                    'content' => $name,
                ],
            ],
        ]);

        return $response->choices[0]->message->content;
    }
}
