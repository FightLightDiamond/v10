import React, { useEffect, useState } from "react";
import styles from "../../../styles/fighting-match.module.css";
import { IMatchLog } from "@/App/interfaces/match-log.interface";
import Countdown from "react-countdown";
import { currentBet, IBetState, placeBet } from "@/App/Http/Store/Reducers/bet.slice";
import { useDispatch, useSelector } from "react-redux";
import { RootState } from "@/App/Http/Store";
import HeroTurn from "@/Components/hero/hero-select";
import { Spinner, Button } from "@material-tailwind/react";
const BettingMatch = ({ id, items, start_time }: { id: number, items: any, start_time: number }) => {
  const bet: IBetState = useSelector((state: RootState) => state.bet);
  const auth = useSelector((state: RootState) => state.auth);
  const dispatch = useDispatch();
  /**
   * State
   */
  const [home, setHome] = useState<IMatchLog>();
  const [away, setAway] = useState<IMatchLog>();

  useEffect(() => {
    if (items.length > 1) {
      setHome(items[0])
      setAway(items[1])
    }
  }, [items]);

  useEffect(() => {
    //Get bet buy match id
    if (auth.isAuthentication) {
      dispatch({
        type: currentBet.type,
        payload: {
          match_id: id
        }
      })
    }
  }, [id, auth])

  useEffect(() => {
    if (bet.bet.item?.id) {
      setCentredModal(false)
    }
  }, [bet.bet.item])

  const [balance, setBalance] = useState<number>(1000);
  const [centredModal, setCentredModal] = useState(false);
  const toggleShow = () => setCentredModal(!centredModal);

  const handleBet = (hero_id: number | undefined) => {
    dispatch({
      type: placeBet.type,
      payload: {
        match_id: id,
        hero_id: hero_id,
        balance: balance,
      }
    }
    )
  }

  return (
    <div>
      <div className="grid grid-rows-2 grid-flow-col gap-4">
        <div>
          BET TIME: <Countdown date={start_time} />
        </div>
      </div>
      <div className={styles.card + " grid grid-rows-2 grid-flow-col gap-4"}>
        <div>
          {home ? <HeroTurn hero={home} /> : <Spinner />}
        </div>
        <div>
          {away ? <HeroTurn hero={away} /> : <Spinner />}
        </div>
      </div>
      {
        !bet.bet.item ? <div className={"justify-content-md-center"}>
          <Button onClick={toggleShow}>BET</Button>
        </div> : ''
      }

      <MDBModal tabIndex='-1' show={centredModal} setShow={setCentredModal}>
        <MDBModalDialog centered>
          <MDBModalContent>
            <MDBModalHeader>
              <MDBModalTitle>Betting</MDBModalTitle>
              <Button className='btn-close' divor='none' onClick={toggleShow}></Button>
            </MDBModalHeader>
            <MDBModalBody>
              <form>
                <MDBInput onChange={(e) => {
                  setBalance(e.target.value === '' ? 0 : parseInt((e.target.value).replaceAll(',', '')))
                }}
                  className='mb-4' value={Intl.NumberFormat().format(balance)} type='text' label='Gold for bet' />
                <Form.Label>Remaining: ${Intl.NumberFormat().format(auth.balance - balance)}</Form.Label>
                <Form.Range divor="dark" value={balance} min={0} max={auth.balance} onChange={(e) => setBalance(parseInt(e.target.value))} />
                <div>
                  <div className='xs-2'>
                    <Button block divor="dark" type='button' outline={balance !== auth.balance * 0.05}
                      onClick={() => setBalance(auth.balance * 0.05)}
                    >
                      5%
                    </Button>
                  </div>
                  <div className='xs-2'>
                    <Button block divor="dark" type='button' outline={balance !== auth.balance * 0.25}
                      onClick={() => setBalance(auth.balance * 0.25)}>
                      25%
                    </Button>
                  </div>
                  <div className='xs-2'>
                    <Button block divor="dark" type='button' outline={balance !== auth.balance * 0.5}
                      onClick={() => setBalance(auth.balance * 0.5)}>
                      50%
                    </Button>
                  </div>
                  <div className='xs-2'>
                    <Button block divor="dark" type='button' outline={balance !== auth.balance * 0.75}
                      onClick={() => setBalance(auth.balance * 0.75)}>
                      75%
                    </Button>
                  </div>
                  <div className='xs-2'>
                    <Button block divor="dark" type='button' outline={balance !== auth.balance}
                      onClick={() => setBalance(auth.balance)}>
                      100%
                    </Button>
                  </div>
                </div>
                <div className='mt-5'>
                  <div className='xs-6'>
                    <Button block outline divor="success" type='button'
                      onClick={() => handleBet(home?.id)}
                    >
                      {home?.name}
                    </Button>
                  </div>
                  <div className='xs-6'>
                    <Button block outline divor="danger" type='button' onClick={() => handleBet(away?.id)}>
                      {away?.name}
                    </Button>
                  </div>
                </div>
              </form>
            </MDBModalBody>
          </MDBModalContent>
        </MDBModalDialog>
      </MDBModal>
    </div>
  );
};

export default (BettingMatch);
