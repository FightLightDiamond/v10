import {useDrag} from "react-dnd";
import {memo} from "react";

function Piece({boardId, type}: {boardId: number, type: number,}) {
    const [{isDragging}, drag, dragPreview] = useDrag(() => ({
        type: type + '',
        collect: monitor => ({
            isDragging: monitor.isDragging(),
        }),
        item: {boardId},
        canDrag: () => true,
        end: (draggedItem, monitor) => {
            console.log("END", draggedItem, monitor, boardId)
        }
    }))

    return (
        <>
            {
                isDragging ? (
                    <div ref={dragPreview} />
                ) : <div
                    className={'aspect-square'}
                    ref={drag}
                    style={{
                        opacity: isDragging ? 0.5 : 1,
                        fontSize: 40,
                        fontWeight: 'bold',
                        cursor: 'move',
                        background: "gold"
                    }}
                >
                    <img src="/img/avatar/Hera.png" alt=""/>
                </div>
            }
        </>

    )
}

export default memo(Piece)