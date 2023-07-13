import {
	useSelector as useReduxSelector,
	TypedUseSelectorHook,
} from 'react-redux'
import { RootState } from '../Http/Store/Reducers/_root.reducer';

export const useSelector: TypedUseSelectorHook<RootState> = useReduxSelector;
