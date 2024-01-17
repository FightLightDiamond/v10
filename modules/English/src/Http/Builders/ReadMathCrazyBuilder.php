<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/17/19
 * Time: 11:36 PM
 */

namespace English\Http\Builders;


class ReadMathCrazyBuilder extends TestBuilder
{
    public function getThreads($id)
    {
        $this->crazy = $crazy = $this->repository
            ->find($id);

        $ens = $this->getListRand('sentence');
        $vis = $this->getListRand('meaning');
        $this->data = compact('crazy', 'ens', 'vis');
        $this->courseList()
            ->statistic($this->historyRepository)
            ->getCrazyCourse();

        return  $this->data;
    }

    public function done($id, $sentences, $meanings)
    {
//        $this->crazy = $this->data['crazy'] = $this->repository->find($id);
        $this->crazy = $this->repository->find($id);

        $this->getDetail()
//            ->getSentenceList()
            ->checkTest($sentences, $meanings)
//            ->getCrazyList()
            ->saveHistory($this->historyRepository)
            ->statistic($this->historyRepository)
            ->getCrazyCourse();

        return $this->data;
    }

    private function checkTest($sentences, $meanings)
    {
//        $ens = [];
        $resultMap = [];
        foreach ($this->details as $i => $crazyDetail) {
            $resultMap[$i] = false;
            if ($sentences[$i] == $crazyDetail['id'] && $meanings[$i] === $crazyDetail['meaning']) {
                $this->score++;
                $resultMap[$i] = true;
            }
//            $ens[$i] = $this->sentenceList[$sentences[$i]];
        }
        $this->data['score'] = $this->score;
        $this->data = array_merge($this->data, compact('resultMap'));
        return $this;
    }
}
