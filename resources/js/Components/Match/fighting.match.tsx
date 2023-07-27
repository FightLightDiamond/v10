import { memo, useEffect, useState } from "react";
import styles from "../../../styles/fighting-match.module.css";
import { Col, Row } from "react-bootstrap";
import Spinner from 'react-bootstrap/Spinner';
import { IMatchLog } from "@/App/interfaces/match-log.interface";
import HeroTurn from "../hero/hero-select";
import Countdown from "react-countdown";
import { Button, MDBIcon } from "mdb-react-ui-kit";
import { useEffectOnce } from "@/App/Hooks/useEffectOnce";

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
    <div className={styles.container}>
      <Row className="text-light">
        <Col xs="6">
          FIGHT TIME: <Countdown date={start_time} />
        </Col>
        <Col xs="6">
          ROUND: {home?.turn_number}
        </Col>
      </Row>

      <Row className={styles.card + " justify-content-xs-center"}>
        <Col xs="6">
          {home ? <HeroTurn hero={home} /> : <Spinner variant="light" animation="border" />}
        </Col>
        <Col xs="6">
          {away ? <HeroTurn hero={away} /> : <Spinner variant="light" animation="border" />}
        </Col>
      </Row>
      {indexInterval > 0 && (<Row className="text-light">
        <Col xs="6" className="d-flex justify-content-start">
          {indexInterval === items.length - 1 && (

            <Button floating color="dark"
              onClick={() => setMatch(-1, speedInterval)}>
              <MDBIcon fas icon="redo-alt" />
            </Button>
          )}
        </Col>
        <Col xs="6" className="d-flex justify-content-end">
          <Button className='mx-2' floating color="dark" type='button' outline={speedInterval === 2}
            onClick={() => setSpeedFunc(2)}>
            x2
          </Button>
          <Button floating color="dark" type='button' outline={speedInterval === 4}
            onClick={() => setSpeedFunc(4)}>
            x4
          </Button>
          <Button className='ms-2' floating color="dark" type='button' outline={speedInterval === 8}
            onClick={() => setSpeedFunc(8)}>
            x8
          </Button>
        </Col>
      </Row>)}
    </div >
  );
};

export default memo(FightingMatch);
