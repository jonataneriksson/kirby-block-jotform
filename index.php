<?php

Kirby::plugin('jonataneriksson/kirby-jotform-block', [
  'blueprints' => [
    'blocks/jotform' => __DIR__ . '/blueprints/blocks/jotform.yml'
  ],
  'api' => [
    'routes' => [
        [
          'pattern' => 'jotform',
          'action'  => function () {

            $json = (object)[];
            $jotformAPI = new JotForm("196ff34293fa2e5de7229faf20");
            $json = $jotformAPI->getFormQuestions("211382720050038");

            //createFormSubmission
            return Response::json($json);
          }
        ]
    ],
  ],
  'routes' => [
      [
        'pattern' => 'jotform',
        'action'  => function () {
          $json = (object)[];

          //NO POST DATA
          if( !isset($_POST['fromPerson']) )
          {
            $jotformAPI = new JotForm("196ff34293fa2e5de7229faf20");
            $json = (array) $jotformAPI->getFormQuestions("211382720050038");
          }

          //POST DATA
          if( isset($_POST['answer']) )
          {
            $json = $_POST['answer'];
          }

          //createFormSubmission
          return Response::json($json);
        }
      ]
  ]
]);
