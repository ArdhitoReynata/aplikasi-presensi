import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          fontFamily: {
            inter : ['Inter', 'sans-serif'],
          },
          screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }
    
            'md': '768px',
            // => @media (min-width: 768px) { ... }
    
            'lg': '1028px',
            // => @media (min-width: 1024px) { ... }
    
            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }
    
            '2xl': '1536px',
           // => @media (min-width: 1536px) { ... }
          },
          fontSize: {
            '1' : '1px',
            '2' : '2px',
            '3' : '3px',
            '4' : '4px',
            '5' : '5px',
            '6' : '6px',
            '7' : '7px',
            '8' : '8px',
            '9' : '9px',
            '10' : '10px',
            '11' : '11px',
            '12' : '12px',
            '13' : '13px',
            '14' : '14px',
            '15' : '15px',
            '16' : '16px',
            '17' : '17px',
            '18' : '18px',
            '19' : '19px',
            '20' : '20px',
            '21' : '21px',
    
          },
          width: {
            'tbnav' : '145px',
            'login' : '572px',
            'inputbox' : '480px',
          },
          height: {
            'tbnav' : '40px',
            'login' : '944px',
            'inputbox' : '38px',
          },
          margin: {
            'mrnav' : '18px',
          },
          colors: {
            'black' : '#000000',
            'bgcolor' : '#F5F5F5',
            'strcolor' : '#C9C9C9',
            'tbcolor1' : '#7A7A7A',
            'tbcolor' : '#081C15',
            'btncolor' : '#2D6A4F',
            'btncolor2' : '#40916C',
            'btncolor3' : '#52B788',
            'btncolor4' : '#132B20',
            'dangercolor' : '#DC3545',
            'dangercolor2' : '#B22B37',
            'bgtable' : '#D8F3DC',
          },
          gridTemplateColumns: {
            // Simple 16 column grid
            '13': 'repeat(13, minmax(0, 1fr))',
            '14': 'repeat(14, minmax(0, 1fr))',
            '15': 'repeat(15, minmax(0, 1fr))',
            '16': 'repeat(16, minmax(0, 1fr))',
            '17': 'repeat(17, minmax(0, 1fr))',
            '18': 'repeat(18, minmax(0, 1fr))',
            '19': 'repeat(19, minmax(0, 1fr))',
            '20': 'repeat(20, minmax(0, 1fr))',
            '21': 'repeat(21, minmax(0, 1fr))',
            '22': 'repeat(22, minmax(0, 1fr))',
            '23': 'repeat(23, minmax(0, 1fr))',
            '24': 'repeat(24, minmax(0, 1fr))',
            '25': 'repeat(25, minmax(0, 1fr))',
            '25': 'repeat(25, minmax(0, 1fr))',
            '26': 'repeat(26, minmax(0, 1fr))',
            // Complex site-specific column configuration
            'footer': '200px minmax(900px, 1fr) 100px',
          },
          gridTemplateRows: {
            // Simple 16 column grid
            '13': 'repeat(13, minmax(0, 1fr))',
            '14': 'repeat(14, minmax(0, 1fr))',
            '15': 'repeat(15, minmax(0, 1fr))',
            '16': 'repeat(16, minmax(0, 1fr))',
            '17': 'repeat(17, minmax(0, 1fr))',
            '18': 'repeat(18, minmax(0, 1fr))',
            '19': 'repeat(19, minmax(0, 1fr))',
            '20': 'repeat(20, minmax(0, 1fr))',
            '21': 'repeat(21, minmax(0, 1fr))',
            '22': 'repeat(22, minmax(0, 1fr))',
            '23': 'repeat(23, minmax(0, 1fr))',
            '24': 'repeat(24, minmax(0, 1fr))',
            '25': 'repeat(25, minmax(0, 1fr))',
            '25': 'repeat(25, minmax(0, 1fr))',
            '26': 'repeat(26, minmax(0, 1fr))',
            // Complex site-specific column configuration
            'layout': '200px minmax(900px, 1fr) 100px',
          },
        },
      },
    plugins: [],
};
