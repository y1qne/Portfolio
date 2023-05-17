import { useState } from 'react';
import Artist from './Artist.js';
import Album from './Album.js';
import Genre from './Genre.js';


function Accueil() {

    const [artist_list, setArtistList] = useState([]);
    const [album_list, setAlbumList] = useState([]);
    const [genre_list, setGenreList] = useState([]);


    fetch(`http://localhost:8000/artists?page=1&limit=20&`)
        .then(res => res.json())
        .then(json => {
            setArtistList(json);
        });
    fetch(`http://localhost:8000/albums?page=1&limit=20&`)
    .then(res => res.json())
    .then(json => {
        setAlbumList(json);
    });
    fetch(`http://localhost:8000/genres`)
    .then(res => res.json())
    .then(json => {
        setGenreList(json);
    });

    return (
        <>
            <div className='artist_list_accueil'>
            {
                artist_list.map((artist) => {
                    return <Artist artist_name={artist['name']} artist_pic={artist['photo']}  key={artist['id']} />;
                })
            }
            </div>
            <div className='album_list_accueil'>
            {
                album_list.map((album) => {
                    return <Album album_name={album['name']} album_pic={album['cover']}  key={album['id']} />;
                })
            }
            </div>
            <div className='genre_list_accueil'>
            {
                genre_list.map((genre) => {
                    return <Genre genre_name={genre['name']} key={genre['id']} />;
                })
            }
            </div>
        </>
    );
}

export default Accueil;

