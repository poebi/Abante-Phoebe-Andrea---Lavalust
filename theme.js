const fs = require('fs');
let css = fs.readFileSync('frontend/src/styles.css', 'utf-8');

// Replace greens with reds/oranges
css = css.replace(/--green:#234d3b/g, '--green:#d32f2f');
css = css.replace(/--green-dark:#183e2d/g, '--green-dark:#b71c1c');

// Brand colors
css = css.replace(/#244a38/g, '#c62828');
css = css.replace(/#b4d2a8/g, '#ffcc80');
css = css.replace(/#26362d/g, '#3e2723'); // Text
css = css.replace(/#edf3ef/g, '#ffebee');
css = css.replace(/#284e3b/g, '#d32f2f');
css = css.replace(/#63866b/g, '#e64a19'); // Tip icon
css = css.replace(/#72a981/g, '#ff5722'); // Status dot
css = css.replace(/#e7f2e9/g, '#fbe9e7');
css = css.replace(/#80a77d/g, '#ff7043'); // H1 span
css = css.replace(/#487354/g, '#c62828'); // Mint stat color -> Red
css = css.replace(/#eaf2ec/g, '#ffcdd2'); // Mint stat bg
css = css.replace(/#79a07b/g, '#ff7043'); // Login span
css = css.replace(/#b8d6aa/g, '#ffcc80'); // Login em
css = css.replace(/#244a38/g, '#c62828'); // Quote bg
css = css.replace(/#52785a/g, '#d32f2f'); // Spinner
css = css.replace(/#57785d/g, '#d32f2f'); // Empty icon

fs.writeFileSync('frontend/src/styles.css', css);
console.log('Theme updated to LavaLust Red!');
