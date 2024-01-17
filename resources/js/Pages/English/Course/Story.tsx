import MasterLayout from "@/Layouts/MasterLayout";
import {useState} from "react";
import {HTML5Backend} from "react-dnd-html5-backend";
import {DndProvider, useDrag, useDrop} from "react-dnd";
import {ItemsConstant} from "@/constants/items.constant";
import * as _ from "lodash";

export default function Story(props: any) {
    const {crazy} = props

    const [people, setPeople] = useState(crazy.details)
    const [abc, setAbc] = useState([])

    function MyDropTarget(props) {
        const [collectedProps, drop] = useDrop(() => ({
            accept: 'accept',
            canDrop: () => true,
            drop: (item: any, monitor) => {
                const dropItem = _.find(people, ['id', item.detail_id]);

                if(dropItem) {
                    setAbc([...abc, dropItem])

                    const itemDrags = _.filter(people, (p) => {
                        return p.id != item.detail_id
                    });

                    setPeople([...itemDrags])
                }
            },
            collect: monitor => ({
                isOver: monitor.isOver(),
                canDrop: monitor.canDrop()
            }),
        }))

        return <div ref={drop} className="border-2 border-red">
            Drop target
            {
                abc.map(
                    (detail, index: number) => (
                        <DraggableComponent key={index} detail={detail}></DraggableComponent>
                        // <div key={index}>{JSON.stringify(detail)}</div>
                     )
                )
            }
        </div>
    }

    function DraggableComponent(props) {
        const {detail} = props
        const [collected, drag, dragPreview] = useDrag(() => ({
            type: 'accept',
            item: { detail_id: detail.id },
            collect: monitor => ({
                isDragging: monitor.isDragging(),
            }),
            end: (draggedItem, monitor) => {
                console.log("END", draggedItem, monitor)
            }
        }))
        return collected.isDragging ? (
            <div ref={dragPreview} />
        ) : (

            <div ref={drag} {...collected}>
                {detail.meaning}
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

                    {people.map((detail, index: number) => (
                        <DraggableComponent key={index} detail={detail}></DraggableComponent>
                    ))}

                </DndProvider>
            </div>

        </MasterLayout>
    )
}
