<?php
@include_once __DIR__ . '/vendor/autoload.php';

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
            $jotformAPI = new JotForm(option('jotform.key'));
            $json = $jotformAPI->getFormQuestions(option('jotform.form'));

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
            $jotformAPI = new JotForm(option('jotform.key'));
            $json = (array) $jotformAPI->getFormQuestions(option('jotform.form'));
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
