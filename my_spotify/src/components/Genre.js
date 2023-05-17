function Genre({ genre_name, cle }) {
    const id = `genre-${cle}`;
    return (
        <div className="genre" id={id}>
            <p>{genre_name}</p>
        </div>
    );
}

export default Genre;