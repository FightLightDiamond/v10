import {useEffectOnce} from "@/App/Hooks/useEffectOnce";
import {useDispatch, useSelector} from "react-redux";
import {getCurrentMatch, IMatchState} from "@/App/Http/Store/Reducers/match.slice";
import {RootState} from "@/App/Http/Store";
import {BETTING_STATUS, FIGHTING_STATUS} from "@/constants/bet-status.constant"
import FightingMatch from "../Components/Match/fighting.match";
import {memo, useEffect, useState} from "react";
import BettingMatch from "../Components/Match/betting.match";
import {PageProps} from "@/types";

const Home = ({ auth, laravelVersion, phpVersion }: PageProps<{ laravelVersion: string, phpVersion: string }>) => {
  const dispatch = useDispatch();
  const match: IMatchState = useSelector((state: RootState) => state.match);
  const {currentMatch} = match
  const {item} = currentMatch
  const {start_time, id} = item

  useEffectOnce(() => {
    dispatch({
      type: getCurrentMatch.type
    })
  });

  const [hero_info, setHeroInfo] = useState([])
  const [turns, setTurns] = useState([])
    console.log({hero_info})
  useEffect(() => {
    if(item.status === BETTING_STATUS) {
      const hero_info = JSON.parse(item.hero_info)
      setHeroInfo(hero_info)
    }
    if(item.status === FIGHTING_STATUS) {
      const turns = JSON.parse(item.turns)
      setTurns(turns)
    }
  }, [item.id, item.status])

  return (
    <div className={"container"}>
      <div>
        {
          item.status === BETTING_STATUS ? <BettingMatch id={id} start_time={parseInt(start_time) + 60*1000} items={hero_info} />
            : item.status === FIGHTING_STATUS ? <FightingMatch start_time={parseInt(start_time) + 60*3*1000 } items={turns} />  : "END_STATUS"
        }
      </div>
    </div>
  );
};

export default memo(Home);
