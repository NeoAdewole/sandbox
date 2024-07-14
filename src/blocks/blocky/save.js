import { useBlockProps } from '@wordpress/block-editor';

export default function () {
  // const blockProps = useBlockProps().save
  return (
    <div {...useBlockProps.save()}>
      {'Hello Blocky from save'}
    </div>
  )
}