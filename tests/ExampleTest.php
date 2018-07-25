<?php

class ExampleTest extends TestCase
{
    /*
     * ->seeJson([
                 'created' => true,
             ]);


      ->seeJsonStructure([
                 'name',
                 'pet' => [
                     'name', 'age'
                 ]
             ]);

    ->seeJsonStructure([
                 '*' => [
                     'id', 'name', 'email'
                 ]
             ]);


    >seeJsonStructure([
         '*' => [
             'id', 'name', 'email', 'pets' => [
                 '*' => [
                     'name', 'age'
                 ]
             ]
         ]
     ]);

     */
    public function testRouteIndex()
    {
        $response = $this->json('GET', '/');
        $response
            ->assertResponseStatus(200)
            ->seeJsonEquals([
                'error' => 'invalid args'
            ]);
    }
}
