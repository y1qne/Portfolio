import { useEffect, useState } from 'react';
import './App.css';
import ArtistList from './components/ArtistList.js';
import AlbumList from './components/AlbumList.js';
import GenreList from './components/GenreList.js';
import Accueil from './components/Accueil.js';



function App() {

    const [where, setWhere] = useState('homepage');

    switch (where){
        case 'homepage':
            return (
                <>
                    <div className="navbar">
                        <li><button className="nav-links" onClick={()=>{setWhere('homepage')}}>HOMEPAGE</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('artists')}}>ARTISTS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('albums')}}>ALBUMS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('genres')}}>GENRES</button></li>
                    </div>
        
                    <div className='content'><Accueil /></div>
                </>
            );
        case 'artists':
            return (
                <>
                    <div className="navbar">
                        <li><button className="nav-links" onClick={()=>{setWhere('homepage')}}>HOMEPAGE</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('artists')}}>ARTISTS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('albums')}}>ALBUMS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('genres')}}>GENRES</button></li>
                    </div>
        
                    <div className='content'><ArtistList /></div>
                </>
            );
        case 'albums':
            return (
                <>
                    <div className="navbar">
                        <li><button className="nav-links" onClick={()=>{setWhere('homepage')}}>HOMEPAGE</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('artists')}}>ARTISTS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('albums')}}>ALBUMS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('genres')}}>GENRES</button></li>
                    </div>
        
                    <div className='content'><AlbumList /></div>
                </>
            );
        case 'genres':
            return (
                <>
                    <div className="navbar">
                        <li><button className="nav-links" onClick={()=>{setWhere('homepage')}}>HOMEPAGE</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('artists')}}>ARTISTS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('albums')}}>ALBUMS</button></li>
                        <li><button className="nav-links" onClick={()=>{setWhere('genres')}}>GENRES</button></li>
                    </div>
        
                    <div className='content'><GenreList /></div>
                </>
            );
    }
}

export default App;

