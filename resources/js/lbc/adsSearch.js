// import dotenv from "dotenv";
// dotenv.config({ path: './.env' });

// import mix from "laravel-mix";
// import webpack from "webpack";
// import dotenv from "dotenv-webpack";

// module.exports = {
//   //...
//   plugins: [
//     new webpack.DefinePlugin({
//       'process.env': JSON.stringify(dotenv.config().parsed)
//     })
//   ]
// };


export function adsSearch() {
    let adsSearches = [
        { // Test (No cnx used - Use json files only)
            name: 'test',
        },
        { // Toutes
            name: 'sdjl20',
            'url': import.meta.env.VITE_LBC_SJDL20
        },
    ];

    console.table(adsSearches);
}
