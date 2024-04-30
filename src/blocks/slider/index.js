import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import edit from './edit.js';
import './main.css';

registerBlockType('custom-cut/slider', {
  icon: 'images-alt',
  edit,
  save: () => <InnerBlocks.Content />
})