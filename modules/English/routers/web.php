<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 4:37 PM
 */

Route::group(['middleware' => ['web'], 'namespace' => 'English\Http\Controllers', 'prefix' => 'english'], function () {
    Route::group(['prefix' => 'test', 'namespace' => 'Test'], function () {
        Route::get('fill-in-the-blanks', 'FillInTheBlankTestController@index')->name('test.fill-in-the-blank.index')->middleware('cacheable');
        Route::post('fill-in-the-blanks', 'FillInTheBlankTestController@done')->name('test.fill-in-the-blank.done');
        Route::get('pronunciations', 'PronunciationTestController@index')->name('test.pronunciation.index')->middleware('cacheable');
        Route::post('pronunciations', 'PronunciationTestController@done')->name('test.pronunciation.done');
        Route::get('mistakes', 'MistakeTestController@index')->name('test.mistake.index')->middleware('cacheable');
        Route::post('mistakes', 'MistakeTestController@done')->name('test.mistake.done');
        Route::get('similarities', 'SimilarityTestController@index')->name('test.similarity.index')->middleware('cacheable');
        Route::post('similarities', 'SimilarityTestController@done')->name('test.similarity.done');
        Route::get('crazies', 'CrazyTestController@index')->name('test.crazy.index')->middleware('cacheable');
        Route::get('crazy-read/{id}', 'CrazyTestController@reading')->name('test.crazy.reading')->middleware('cacheable');
        Route::post('crazy-read/{id}', 'CrazyTestController@read')->name('test.crazy.read');
        Route::get('crazy-write/{id}', 'CrazyTestController@writing')->name('test.crazy.writing')->middleware('cacheable');
        Route::post('crazy-write/{id}', 'CrazyTestController@written')->name('test.crazy.written');
    });

    Route::get('/', 'EnglishController@index')->name('english.index')->middleware('cacheable');
    Route::get('crazy-course-list/{id}', 'CrazyCourseController@getList')->name('crazy-course.list')->middleware('cacheable');
    Route::get('searches', 'VocabularyController@search')->name('vocabulary.search')->middleware('cacheable');
});
