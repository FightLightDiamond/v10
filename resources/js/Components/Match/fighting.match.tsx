import { memo, useEffect, useState } from "react";
import { IMatchLog } from "@/App/interfaces/match-log.interface";
import HeroTurn from "../hero/hero-select";
import Countdown from "react-countdown";
import { useEffectOnce } from "@/App/Hooks/useEffectOnce";
import {Progress} from "@/shadcn/ui/progress";

const FightingMatch = ({ items, start_time, type = "normal" }: { items: any, start_time: number, type?: string }) => {
  /**
   * State
   */
  const [home, setHome] = useState<IMatchLog>();
  const [away, setAway] = useState<IMatchLog>();
  const [speedInterval, setSpeedInterval] = useState<number>(1);
  const [indexInterval, setIndexInterval] = useState<number>(-1);
  const [inter, setInter] = useState<number[]>([]);

  useEffectOnce(() => {
    if (items.length > 0 && type === 'elo') {
      setMatch(-1, 1);
    }
  });

  useEffect(() => {
    if (items.length > 0 && type !== 'elo') {
      setMatch(-1, 1);
    }
  }, [items])

  const setMatch = (store = -1, speed = 1) => {
    let index = store;
    const idHero = items[0].id

    const id = setInterval(() => {
      //Thể hiện hiệu ứng bên Đánh
      ++index
      if (items.length <= index) {
        console.log(items.length, index)
        clearInterval(id);
        return;
      }

      if (idHero === items[index].id) {
        setHome(items[index]);
      } else {
        setAway(items[index]);
      }

      //Đồng thời thể hiện bên chịu sát thương
      ++index
      if (items.length <= index) {
        console.log(items.length, index)
        clearInterval(id);
        return;
      }

      if (idHero === items[index].id) {
        setHome(items[index]);
      } else {
        setAway(items[index]);
      }

      setIndexInterval(index);

    }, 4000 / speed);

    setInter(inter.concat(Number(id)));
  };

  const setSpeedFunc = (speed: number) => {
    inter.map((e) => clearInterval(e));
    setMatch(indexInterval, speed); setSpeedInterval(speed)
  }

  return (
    <div>
      <div className="text-light">
        <div>
          FIGHT TIME: <Countdown date={start_time} />
        </div>
        <div >
          ROUND: {home?.turn_number}
        </div>
      </div>

      <div className={"flex columns-2"}>
        <div className="flex flex-col w-full mr-2">
          {home ? <HeroTurn hero={home} /> : <Progress data-state={"loading"} value={100} className="w-[60%]" />}
        </div>
        <div className="flex flex-col w-full ml-2">
          {away ? <HeroTurn hero={away} /> : <Progress data-state={"loading"} value={100} className="w-[60%]" />}
        </div>
      </div>
      {indexInterval > 0 && (<div className="text-light">
        <div  className="d-flex justify-content-start">
          {indexInterval === items.length - 1 && (

            <button color="dark"
              onClick={() => setMatch(-1, speedInterval)}>
              -----
            </button>
          )}
        </div>
        <div  className="d-flex justify-content-end">
          <button className='mx-2 ' color="dark" type='button'
            onClick={() => setSpeedFunc(2)}>
            x2
          </button>
          <button color="dark" type='button'
            onClick={() => setSpeedFunc(4)}>
            x4
          </button>
          <button className='ms-2' color="dark" type='button'
            onClick={() => setSpeedFunc(8)}>
            x8
          </button>
        </div>
      </div>)}
    </div >
  );
};

export default memo(FightingMatch);
