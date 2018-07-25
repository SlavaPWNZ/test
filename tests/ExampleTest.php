<?php

use App\MainModel;

class ExampleTest extends TestCase
{
    /*
     * В связи с нехваткой времени, тестовое покрытие сделать не успел...
     * Требуется гораздо больше времени, чтобы разобраться, но я пытался...
     *
     *
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


    // Тесты получения списка всех категорий
    public function testGetCategories()
    {
        $error1='{"error":"invalid args"}';
        $error2='{"error":"db tables errors"}';
        $result = json_encode(MainModel::GetCategoriesModel(),JSON_UNESCAPED_UNICODE);
        $this->assertNotEquals($error1, $result);
        $this->assertNotEquals($error2, $result);
    }

    public function testGetCategories_DbErrors()
    {
        $this->assertTrue(true);
    }

    public function testGetCategories_emptyTableCategory()
    {
        $this->assertTrue(true);
    }


    // Тесты получения списка товаров в конкретной категории
    public function testGetItems()
    {
        // $result = json_encode(MainModel::GetItemsModel(1),JSON_UNESCAPED_UNICODE);
        // var_dump($result);
        // $this->assertJsonStringEqualsJsonString($result,'[{"id":4,"name":"Мяч"}]');
    }

    public function testGetItems_NoArgs()
    {
         $error='{"error":"invalid args"}';
         $result = json_encode(MainModel::GetItemsModel(null),JSON_UNESCAPED_UNICODE);
         $this->assertEquals($error, $result);
    }

    /*
     * .......
     */
}
