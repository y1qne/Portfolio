import { useEffect, useState } from 'react';
import Artist from './Artist.js';


function ArtistList() {

    const [artist_list, setArtistList] = useState([]);
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
        fetch(`http://localhost:8000/artists?page=${page}&limit=50&`)
            .then(res => res.json())
            .then(json => {
                setArtistList(json);
            })
    }, [page]);

    return (
        <>
            <div>Artists</div>
            <div className='gallery'>
            {
                artist_list.map((artist) => {
                    return <Artist artist_name={artist['name']} artist_pic={artist['photo']}  cle={artist['id']} />;
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

export default ArtistList;

