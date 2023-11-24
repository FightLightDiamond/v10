import {useEffectOnce} from "@/App/Hooks/useEffectOnce";
import {BETTING_STATUS, FIGHTING_STATUS} from "@/constants/bet-status.constant"
import FightingMatch from "../Components/Match/fighting.match";
import {memo, useEffect, useState} from "react";
import BettingMatch from "../Components/Match/betting.match";
import {PageProps} from "@/types";

const Home = ({currentMatch}: PageProps<{ currentMatch: any }>) => {
    const {start_time, id} = currentMatch

    const [turns, setTurns] = useState([])
    const [status, setStatus] = useState(0)

    useEffectOnce(() => {
        window.Echo.channel('match')
            .listen('.bet', (event: any) => {
                setStatus(event.match.status);
                setTurns(JSON.parse(event.match.hero_info))
                console.log('bet:', event);
            });
        window.Echo.channel('match')
            .listen('.fight', (event: any) => {
                setStatus(event.match.status);
                setTurns(JSON.parse(event.match.turns))
                console.log('fight:', event);
            });
    });

    useEffect(() => {
        setStatus(currentMatch.status);
        if (currentMatch.status === BETTING_STATUS) {
            setTurns(JSON.parse(currentMatch.hero_info))
        }
        if (currentMatch.status === FIGHTING_STATUS) {
            setTurns(JSON.parse(currentMatch.turns))
        }
    }, [currentMatch.id, currentMatch.status])

    return (
        <div className={"container"}>
            <svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="animate-spin  w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            <div>
                {
                    status === BETTING_STATUS ?
                        <BettingMatch id={id} start_time={parseInt(start_time) + 60 * 1000} items={turns}/>
                        : status === FIGHTING_STATUS ?
                            <FightingMatch start_time={parseInt(start_time) + 60 * 3 * 1000} items={turns}/> : "END_STATUS"
                }
            </div>
        </div>
    );
};

export default memo(Home);
