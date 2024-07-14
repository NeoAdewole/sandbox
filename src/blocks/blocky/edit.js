import { useBlockProps } from '@wordpress/block-editor';
import { useState, useEffect } from '@wordpress/element';
import './editor.scss';

export default function ({ attributes }) {
  const { content } = attributes

  const [watch, setWatch] = useState(0);

  useEffect(() => {
    const next = (watch + 1);
    const id = setTimeout(() => setWatch(next), 3000);
    return () => clearTimeout(id)
  }, [watch])

  return (
    <div {...useBlockProps()}>
      Hello Blocky - Block Editor {watch}
    </div>
  )
}