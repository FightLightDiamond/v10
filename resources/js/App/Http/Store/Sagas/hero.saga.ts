import {put, takeLeading} from 'redux-saga/effects'
import {
  getHeroes,
  getHeroesError,
  getHeroesSuccess
} from '../Reducers/hero.slice'

import heroService from "../../Services/hero.service";
import {IAction} from "../IAction";

function* heroWorker(action: IAction<any>): any {
  const [response, error] = yield heroService.index(action.payload)


  if (error) {
    yield put({type: getHeroesError.type})
  } else {
    const {data} = response
    const payload = data ?? response

    console.log({response, error, payload})
    yield put({type: getHeroesSuccess.type, payload})
  }
}

function* heroWatcher() {
  yield takeLeading(getHeroes, heroWorker)
}

export default heroWatcher
