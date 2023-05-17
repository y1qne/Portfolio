import { useEffect, useState } from 'react';
import './App.css';
import ArtistList from './components/ArtistList.js';
import AlbumList from './components/AlbumList.js';
import GenreList from './components/GenreList.js';


function App() {

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
            {
                artist_list.map((artist) => {
                    return <Artist artist_name={artist['name']}  key={artist['id']} />;
                })
            }
            <div className='pageDiv'>
              <button className='pageButton' onClick={prevPage}>Previous Page</button>
              <p>Page {page}</p>
              <button className='pageButton' onClick={nextPage}>Next page</button>
            </div>
        </>
    );
}

export default App;

