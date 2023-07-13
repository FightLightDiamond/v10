import {createSlice, PayloadAction} from '@reduxjs/toolkit'
export const KING = 0
export const QUEEN = 1
export const ROOK = 2
export const BISHOP = 3
export const KNIGHT = 4
export const PAWN = 5
export const WHITE = 0
export const BLACK = 1

export const pieces = ['King', 'Queen', 'Rook', 'Bishop', 'Knight', 'Pawn']
export const sides = ['white', 'black']

export interface IPiece {
	piece?: number, side?: number, x?: number, y?: number, is_alive?: number
}

const board = [
	{piece: ROOK, side: 0, x: 0, y: 0, is_alive: 1},
	{piece: KNIGHT, side: 0, x: 1, y: 0, is_alive: 1},
	{piece: BISHOP, side: 0, x: 2, y: 0, is_alive: 1},
	{piece: KING, side: 0, x: 3, y: 0, is_alive: 1},
	{piece: QUEEN, side: 0, x: 4, y: 0, is_alive: 1},
	{piece: ROOK, side: 0, x: 5, y: 0, is_alive: 1},
	{piece: KNIGHT, side: 0, x: 6, y: 0, is_alive: 1},
	{piece: BISHOP, side: 0, x: 7, y: 0, is_alive: 1},
	{},{},{},{},{},{},{},{},
	{},{},{},{},{},{},{},{},
	{},{},{},{},{},{},{},{},
	{},{},{},{},{},{},{},{},
	{},{},{},{},{},{},{},{},
	{},{},{},{},{},{},{},{},
	{piece: ROOK, side: 1, x: 0, y: 7, is_alive: 1},
	{piece: KNIGHT, side: 1, x: 1, y: 7, is_alive: 1},
	{piece: BISHOP, side: 1, x: 2, y: 7, is_alive: 1},
	{piece: KING, side: 1, x: 3, y: 7, is_alive: 1},
	{piece: QUEEN, side: 1, x: 4, y: 7, is_alive: 1},
	{piece: ROOK, side: 1, x: 5, y: 7, is_alive: 1},
	{piece: KNIGHT, side: 1, x: 6, y: 7, is_alive: 1},
	{piece: BISHOP, side: 1, x: 7, y: 7, is_alive: 1},
]

interface piece {
	piece: string,
	side: string,
	x: number,
	y: number,
	is_alive: boolean
}

interface IState {
	x: number,
	y: number,
	0?: {
		x: number,
		y: number,
	},
	cart?: [
		{id: 1, itemId: null},
		{id: 2, itemId: null},
		{id: 3, itemId: null},
		{id: 4, itemId: null},
		{id: 5, itemId: null},
		{id: 6, itemId: null},
		{id: 7, itemId: null},
		{id: 8, itemId: null},
	]
	turns?: [
		{id: 1, itemId: null},
		{id: 2, itemId: null},
		{id: 3, itemId: null},
		{id: 4, itemId: null},
		{id: 5, itemId: null},
		{id: 6, itemId: null},
		{id: 7, itemId: null},
		{id: 8, itemId: null},
		{id: 9, itemId: null},
		{id: 10, itemId: null},
		{id: 11, itemId: null},
		{id: 12, itemId: null},
		{id: 13, itemId: null},
		{id: 14, itemId: null},
		{id: 15, itemId: null},
	],
	board: IPiece[]
}

const initialState: IState = {
	x: 0,
	y: 0,
	board: board
}

export const chessSlice = createSlice({
	name: 'chess',
	initialState,
	reducers: {
		move: (state: IState, action: PayloadAction<{
			x: number, y: number
		}>) => {
			state.x = action.payload.x
			state.y = action.payload.y
		},
	},
})

export const {
	move,
} = chessSlice.actions

export default chessSlice.reducer
