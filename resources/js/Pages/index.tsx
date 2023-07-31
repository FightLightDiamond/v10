import {useEffectOnce} from "@/App/Hooks/useEffectOnce";
import {useDispatch, useSelector} from "react-redux";
import {getCurrentMatch, IMatchState} from "@/App/Http/Store/Reducers/match.slice";
import {RootState} from "@/App/Http/Store";
import {BETTING_STATUS, FIGHTING_STATUS} from "@/constants/bet-status.constant"
import FightingMatch from "../Components/Match/fighting.match";
import {memo, useEffect, useState} from "react";
import BettingMatch from "../Components/Match/betting.match";
import {PageProps} from "@/types";

const Home = ({auth, laravelVersion, phpVersion}: PageProps<{ laravelVersion: string, phpVersion: string }>) => {
    const dispatch = useDispatch();
    const match: IMatchState = useSelector((state: RootState) => state.match);
    const {currentMatch} = match
    const {item} = currentMatch
    const {start_time, id} = item

    const [hero_info, setHeroInfo] = useState([])
    const [turns, setTurns] = useState([])
    const [status, setStatus] = useState(0)

    useEffectOnce(() => {
        dispatch({
            type: getCurrentMatch.type
        })
        window.Echo.channel('match')
            .listen('.bet', (event: any) => {
                setStatus(event.match.status);
                setHeroInfo(JSON.parse(event.match.hero_info))
                console.log('bet:', event);
            });
        window.Echo.channel('match')
            .listen('.fight', (event: any) => {
                setStatus(event.match.status);
                setHeroInfo(JSON.parse(event.match.turns))
                console.log('fight:', event);
            });
    });


    useEffect(() => {
        setStatus(item.status);
        if (item.status === BETTING_STATUS) {
            setHeroInfo(JSON.parse(item.hero_info))
        }
        if (item.status === FIGHTING_STATUS) {
            setTurns(JSON.parse(item.turns))
        }
    }, [item.id, item.status])

    return (
        <div className={"container"}>
            <div>
                {
                    status === BETTING_STATUS ?
                        <BettingMatch id={id} start_time={parseInt(start_time) + 60 * 1000} items={hero_info}/>
                        : status === FIGHTING_STATUS ?
                            <FightingMatch start_time={parseInt(start_time) + 60 * 3 * 1000} items={turns}/> : "END_STATUS"
                }
            </div>
        </div>
    );
};

export default memo(Home);
