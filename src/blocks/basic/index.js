import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json'
import './style.css'

registerBlockType(metadata.name, {
  icon: 'book',
  edit: () => {
    const blockProps = useBlockProps();
    return <div {...blockProps}>Our testy block init?</div>
  }
})
