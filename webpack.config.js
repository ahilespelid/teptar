const path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: {
        leader: path.resolve(__dirname, './assets/leader/js/app.js'),
    },
    output: {
        path: path.resolve(__dirname, './public/build'),
    },
    module: {
        rules: [
            {
                test: /\.(sa|sc|c)ss$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
        ],
    },
    plugins: [new MiniCssExtractPlugin()],
}
