import store from "../../App/Http/Store";

export function canMoveKnight(toX: number, toY: number) {
    const newState = store.getState().chess;
    const [x, y] = [newState.x, newState.y]
    const dx = toX - x
    const dy = toY - y

    return (
        (Math.abs(dx) === 2 && Math.abs(dy) === 1) ||
        (Math.abs(dx) === 1 && Math.abs(dy) === 2)
    )
}