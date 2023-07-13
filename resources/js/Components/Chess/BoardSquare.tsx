import React, {memo} from 'react'
import Square from './Square'
import {useDrop} from "react-dnd";
import {ItemsConstant} from "../../constants/items.constant";
import {useDispatch} from "react-redux";
import {move} from "../../App/Http/Store/Reducers/chess.slice";
import {canMoveKnight} from "./Game";

function Overlay({color}: any) {
    return <div
        style={{
            position: 'absolute',
            top: 0,
            left: 0,
            height: '100%',
            width: '100%',
            zIndex: 1,
            opacity: 0.5,
            backgroundColor: color,
        }}
    />
}

function BoardSquare({ x, y, children }: {x: number, y: number, children: any}) {
    const black = (x + y) % 2 === 1
    const dispatch = useDispatch();

    const [{ isOver, canDrop }, drop] = useDrop(() => ({
        accept: [ItemsConstant.KNIGHT],
        canDrop: () => canMoveKnight(x, y),
        drop: () => dispatch({type: move.type, payload: {x, y}}),
        collect: monitor => ({
            isOver: !!monitor.isOver(),
            canDrop: !!monitor.canDrop()
        }),
    }), [x, y])

    return (
        <div
            ref={drop}
            role={'Dustbin'}
            style={{
                position: 'relative',
                width: '100%',
                height: '100%'
            }}
        >
            <Square black={black}>{children}</Square>
            {isOver && !canDrop && <Overlay color="red" />}
            {!isOver && canDrop && <Overlay color="yellow" />}
            {isOver && canDrop && <Overlay color="green" />}
        </div>
    )
}

export default memo(BoardSquare)