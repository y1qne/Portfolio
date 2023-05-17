import { useEffect, useState } from 'react';
import Album from './Album.js';


function AlbumList() {

    const [album_list, setAlbumList] = useState([]);
    const [page, setPage] = useState(1);

    function prevPage() {
        if (page === 1) {
            return;
        }
        setPage(page - 1);
    }

    function nextPage() {
        setPage(page + 1);
    }

    useEffect(() => {
        fetch(`http://localhost:8000/albums?page=${page}&limit=50&`)
            .then(res => res.json())
            .then(json => {
                setAlbumList(json);
            })
    }, [page]);

    return (
        <>
            <div>Albums</div>
            <div className='gallery'>
            {
                album_list.map((album) => {
                    return <Album album_name={album['name']} album_pic={album['cover']}  cle={album['id']} key={album['id']} />;
                })
            }
            </div>
            <div className='pageDiv'>
              <button className='pageButton' onClick={prevPage}>Previous Page</button>
              <p>Page {page}</p>
              <button className='pageButton' onClick={nextPage}>Next page</button>
            </div>
        </>
    );
}

export default AlbumList;

