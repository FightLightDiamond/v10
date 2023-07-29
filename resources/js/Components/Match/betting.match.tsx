import React, {useEffect, useState} from "react";
import {IMatchLog} from "@/App/interfaces/match-log.interface";
import Countdown from "react-countdown";
import {currentBet, IBetState, placeBet} from "@/App/Http/Store/Reducers/bet.slice";
import {useDispatch, useSelector} from "react-redux";
import {RootState} from "@/App/Http/Store";
import HeroTurn from "@/Components/hero/hero-select";
import {Button} from "@/shadcn/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/shadcn/ui/dialog"
import {Input} from "@/shadcn/ui/input"
import {Label} from "@/shadcn/ui/label"
import {Slider} from "@/shadcn/ui/slider"
import {usePage} from "@inertiajs/react";
import {PageProps} from "@/types";

const BettingMatch = ({id, items, start_time}: { id: number, items: any, start_time: number }) => {
    const dispatch = useDispatch();
    /**
     * State
     */
    const [home, setHome] = useState<IMatchLog>();
    const [away, setAway] = useState<IMatchLog>();

    const {auth} = usePage<PageProps>().props;
    const {user} = auth

    useEffect(() => {
        if (items.length > 1) {
            setHome(items[0])
            setAway(items[1])
        }
    }, [items]);

    // useEffect(() => {
    //     //Get bet buy match id
    //     if (auth.id) {
    //         dispatch({
    //             type: currentBet.type,
    //             payload: {
    //                 match_id: id
    //             }
    //         })
    //     }
    // }, [id, auth])

    const [balance, setBalance] = useState<number>(1000);

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

    // @ts-ignore
    return (
        <div>
            <div className="grid grid-rows-2 grid-flow-col gap-4">
                <div>
                    BET TIME: <Countdown date={start_time}/>
                </div>
            </div>
            <div className="flex flex-row">
                <div>
                    {home ? <HeroTurn hero={home}/> : <span className="loading loading-infinity loading-lg"></span>}
                </div>
                <div>
                    {away ? <HeroTurn hero={away}/> : <span className="loading loading-infinity loading-lg"></span>}
                </div>
            </div>
            {/*{*/}
            {/*  // !bet.bet.item ?*/}
            {/*  <div className={"justify-content-md-center"}>*/}
            {/*      <Button className="btn" onClick={()=>window.my_modal_1.showModal()}>BET</Button>*/}
            {/*  </div>*/}
            {/*      // : ''*/}
            {/*}*/}
            <Dialog>
                <DialogTrigger asChild>
                    <Button variant="outline">BET</Button>
                </DialogTrigger>
                <DialogContent className="sm:max-w-[425px]">
                    <DialogHeader>
                        <DialogTitle>Edit profile</DialogTitle>
                        <DialogDescription>
                            Make changes to your profile here. Click save when you're done.
                        </DialogDescription>
                    </DialogHeader>
                    <div className="grid gap-4 py-4">
                        <div className="grid grid-cols-4 items-center gap-4">
                            <Label htmlFor="name" className="text-right">
                                Gold
                            </Label>
                            <Input id="name" className="col-span-3"
                                   onChange={(e) => {
                                       setBalance(e.target.value === '' ? 0 : parseInt((e.target.value).replaceAll(',', '')))
                                   }}
                                   value={Intl.NumberFormat().format(balance)}
                            />
                        </div>

                        <div className="grid grid-cols-4 items-center gap-4">
                            <label>Remaining: ${Intl.NumberFormat().format(user?.balance - balance)}</label>
                            <Slider
                                value={[balance]}
                                defaultValue={[50]}
                                max={user?.balance}
                                step={1}

                            />
                        </div>

                        <div className={'flex justify-between'}>
                            <div>
                                <Button
                                    onClick={() => setBalance(user?.balance * 0.05)}
                                >
                                    5%
                                </Button>
                            </div>
                            <div>
                                <Button
                                    onClick={() => setBalance(user?.balance * 0.25)}>
                                    25%
                                </Button>
                            </div>
                            <div>
                                <Button
                                    onClick={() => setBalance(user?.balance * 0.5)}>
                                    50%
                                </Button>
                            </div>
                            <div>
                                <Button
                                    onClick={() => setBalance(user?.balance * 0.75)}>
                                    75%
                                </Button>
                            </div>
                            <div>
                                <Button
                                    onClick={() => setBalance(user?.balance)}>
                                    100%
                                </Button>
                            </div>
                        </div>
                        <div className='flex justify-between'>
                            <div>
                                <Button
                                    onClick={() => handleBet(home?.id)}
                                >
                                    {home?.name}
                                </Button>
                            </div>
                            <div>
                                <Button onClick={() => handleBet(away?.id)}>
                                    {away?.name}
                                </Button>
                            </div>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button type="submit">Save changes</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
    );
};

export default (BettingMatch);
