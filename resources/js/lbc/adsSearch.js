import dotenv from "dotenv";
dotenv.config({ path: './.env' });

export function adsSearch() {
    let adsSearches = [
        { // Test (No cnx used - Use json files only)
            name: 'test',
        },
        { // Toutes
            name: 'sdjl20',
            'url': process.env.SJDL20
        },
    ];

    console.table(adsSearches);
}
