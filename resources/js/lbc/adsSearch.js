
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
