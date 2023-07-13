import React from "react";
import Board from "../Components/Chess/Board";
import {useDispatch} from "react-redux";
import {useEffectOnce} from "@/App/Hooks/useEffectOnce";
import {move} from "@/App/Http/Store/Reducers/chess.slice";

export default function G() {
    const dispatch = useDispatch()

    useEffectOnce(() => {
        dispatch({type: move.type, payload: {x: 0, y: 0}})
    });

    return <>
        <Board/>,
    </>
}

