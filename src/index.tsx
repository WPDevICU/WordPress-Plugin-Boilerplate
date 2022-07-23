import { render } from '@wordpress/element';
import './data/store';
import './index.scss';
import menuFix from './utils/menuFix';

const WPB = (): JSX.Element => {
	return (
		<h1>Start from here.</h1>
	);
};

render(<WPB />, document.getElementById('wpb'));

menuFix('wpb');
