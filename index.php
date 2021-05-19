<?php

Kirby::plugin('jonataneriksson/kirby-jotform-block', [
  'blueprints' => [
    'blocks/slide' => __DIR__ . '/blueprints/blocks/jotform.yml'
  ],
  'routes' => function ($kirby) {
    return [
      [
        'pattern' => 'jotform',
        'action'  => function () {

          $jotformAPI = new JotForm("196ff34293fa2e5de7229faf20");
          $form = $jotformAPI->getFormQuestions("211382720050038");

          //createFormSubmission
          return Response::json($form);
        }
      ]
    ];
  }
]);
