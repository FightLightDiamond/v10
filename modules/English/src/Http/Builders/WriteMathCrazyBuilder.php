<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 11:39 PM
 */

namespace English\Http\Builders;



class WriteMathCrazyBuilder extends TestBuilder
{
    public function getThreads($id)
    {
        $this->crazy = $crazy = $this->repository->find($id, ['id', 'name', 'audio', 'crazy_course_id']);

        $lessons = $this->getLesson('sentence');
//        $items = clone $lessons;
//        $lists = $lessons->replicate();

        $ens = $this->getListHash($lessons);
//        dump($lists->toArray());
        $randEns = $this->getListRandEn($lessons);
//        $vis = $this->getListRand('meaning');
        $this->data = compact('crazy', 'ens', 'vis', 'randEns');

//        $this->courseList()
//            ->statistic($this->crazyWriteHistoryRepository)
//            ->getCrazyCourse();

        return $this->data;
    }

    public function done($id, $sentences, $meanings)
    {
//        dd(request()->route()->getAction()['middleware']);
//        $this->crazy = $this->data['crazy'] = $this->repository->find($id);
        $this->crazy = $this->repository->find($id);

        $this->getDetail()
//            ->getSentenceList()
            ->checkWritten($sentences, $meanings)
//            ->getCrazyList()
            ->saveHistory($this->crazyWriteHistoryRepository)
            ->statistic($this->crazyWriteHistoryRepository);
//            ->getCrazyCourse();

        return $this->data;
    }


    private function getLesson($field)
    {
        return $this->crazy->details()
            ->orderBy('no')
            ->select($field, 'id')->get()->toArray();
    }

    private function getListHash($lessons)
    {
        foreach ($lessons as $id => $lesson) {
            $lessons[$id]['sentence'] = $this->hash($lesson['sentence']);
        }

        return $lessons;
    }

    private function getListRandEn($lessons) {

//        dd($lessons->toArray());
        foreach ($lessons as $id => $lesson) {
            $lessons[$id]['sentence'] = $this->rand($lesson['sentence']);
        }

        return $lessons;
    }

    private function hash($subject)
    {
        $pattern = '/[a-zA-Z]{1}/';
//        $pattern = '/[a-o]{1}/';
        return preg_replace($pattern, '*', $subject);
    }

    private function rand($subject) {
        $array = explode(' ', $subject);
        $array = $this->shuffle_assoc($array);

        return implode(' ', $array);
    }

    private function mix($subject)
    {
        $array = explode(' ', $subject);
        return $this->shuffle_assoc($array);
    }

    function shuffle_assoc($array) {
        $keys = array_keys($array);
        shuffle($keys);
        shuffle($keys);
        $new = [];

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        return $new;
    }

    private function checkWritten($sentences, $meanings)
    {
//        $lesson = $this->getLesson('sentence');
//        $ens = $this->getListHash($lesson);
//        $randEns = $this->getListRandEn($lesson);
        $resultMap = [];

        foreach ($this->details as $i => $crazyDetail) {
            $crazyDetailId = $crazyDetail['id'];
            $resultMap[$crazyDetailId] = false;
            if ($this->isWritePass($sentences[$crazyDetailId], $crazyDetail['sentence'], $meanings[$crazyDetailId], $crazyDetail['meaning'])) {
                $this->score++;
                $resultMap[$crazyDetailId] = true;
            }
        }

        $this->data['score'] = $this->score;
        $this->data = array_merge($this->data, compact(  'resultMap'));

        return $this;
    }

    private function isWritePass($sentenceIn, $sentence, $meaningIn, $meaning)
    {
        return ($sentenceIn === $sentence && $meaningIn === $meaning);
    }
}
