import {memo} from "react";

function Square({ black, children }: {black: boolean, children: any}) {
    const fill = black ? 'black' : 'white'
    const stroke = black ? 'white' : 'black'
    return <div
        className={'aspect-square'}
        style={{
            backgroundColor: fill,
            color: stroke,
            width: '100%',
            height: '100%'
        }}
    >
        {children}
    </div>
}

export default memo(Square)