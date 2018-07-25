<?php

use App\MainModel;

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
    public function testIndex()
    {
        $response = $this->json('GET', '/');
        $response
            ->seeJsonEquals([
                'error' => 'invalid args'
            ]);
    }

    public function testGetCategories()
    {
        $error1='{"error":"invalid args"}';
        $error2='{"error":"db tables errors"}';
        $result = json_encode(MainModel::GetCategoriesModel(),JSON_UNESCAPED_UNICODE);
        $this->assertNotEquals($error1, $result);
        $this->assertNotEquals($error2, $result);
    }

    public function testGetItems_NoArgs()
    {
        $error='{"error":"invalid args"}';
        $result = json_encode(MainModel::GetItemsModel(null),JSON_UNESCAPED_UNICODE);
        $this->assertEquals($error, $result);
    }


}
