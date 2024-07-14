import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import './style.scss';
import edit from './edit.js';
import save from './save.js';

registerBlockType('neo-sandbox/blocky', {
  icon: 'admin-generic',
  edit: edit,
  // () => {
  //   const blockProps = useBlockProps();
  //   return <div {...blockProps}>Our blocky playgound init?</div>
  // },
  save: save
})
