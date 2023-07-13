import React, {memo} from 'react'
import Knight from './Pieces/Knight'
import {DndProvider} from "react-dnd";
import {HTML5Backend} from 'react-dnd-html5-backend'
import BoardSquare from "./BoardSquare";
import {useSelector} from "react-redux";
import {RootState} from "../../App/Http/Store";

function Board() {
    const chess  = useSelector((state: RootState) => state.chess);
    function renderSquare(i: number) {
        const x = i % 8
        const y = Math.floor(i / 8)

        function renderPiece(x: number, y: number) {
            if (x === chess.x && y === chess.y) {
                return <Knight boardId={i} />
            }
        }

        return (
            <div key={i} style={{width: '12.5%', height: '12.5%'}}>
                <BoardSquare x={x} y={y}>
                    {renderPiece(x, y)}
                </BoardSquare>
            </div>
        )
    }

    const squares = []
    for (let i = 0; i < 64; i++) {
        squares.push(renderSquare(i))
    }

    return (
        <div className='container h-screen w-auto aspect-square'>
            <DndProvider backend={HTML5Backend}>
                <div
                    style={{
                        width: '100%',
                        height: '100%',
                        display: 'flex',
                        flexWrap: 'wrap'
                    }}
                >
                    {squares}
                </div>
            </DndProvider>
        </div>
    )
}

export default memo(Board)
