import MasterLayout from "@/Layouts/MasterLayout";
import {useRef, useState} from "react";
import {HTML5Backend} from "react-dnd-html5-backend";
import {DndProvider, useDrag, useDrop} from "react-dnd";
import {ItemsConstant} from "@/constants/items.constant";

export default function Story(props: any) {
    const {crazy} = props

    function MyDropTarget(props) {
        const [collectedProps, drop] = useDrop(() => ({
            accept: 'accept',
            canDrop: () => true,
            drop: () => {console.log('props', props)},
            collect: monitor => ({
                isOver: !!monitor.isOver(),
                canDrop: !!monitor.canDrop()
            }),
        }))

        return <div ref={drop}>Drop Target</div>
    }

    function DraggableComponent(props) {
        const {id} = props
        const [collected, drag, dragPreview] = useDrag(() => ({
            type: 'accept',
            item: { id },
            collect: monitor => ({
                isDragging: monitor.isDragging(),
            }),
        }), [id])
        return collected.isDragging ? (
            <div ref={dragPreview} />
        ) : (
            <div ref={drag} {...collected}>
                Drag
            </div>
        )
    }

    return (
        <MasterLayout>
            <h2 className={'text-xl font-semibold text-gray-900'}>{crazy.name}</h2>
            <div className={'text-sm'}>
                {crazy.description}
            </div>
            <audio src={crazy.audio} controls/>
            <div>
                <DndProvider backend={HTML5Backend}>
                    <MyDropTarget k={3}></MyDropTarget>
                    <DraggableComponent id={1}></DraggableComponent>
                </DndProvider>
            </div>

        </MasterLayout>
    )
}
