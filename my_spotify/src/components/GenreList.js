import { useEffect, useState } from 'react';
import Genre from './Genre.js';


function GenreList() {

    const [genre_list, setGenreList] = useState([]);

    fetch(`http://localhost:8000/genres`)
        .then(res => res.json())
        .then(json => {
            setGenreList(json);
        })

    return (
        <>
            <div>Genres</div>
            <div className='gallery'>
            {
                genre_list.map((genre) => {
                    return <Genre genre_name={genre['name']}  cle={genre['id']} />;
                })
            }
            </div>
        </>
    );
}

export default GenreList;

