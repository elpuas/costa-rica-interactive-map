const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
    ...defaultConfig,
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules.filter(rule => !rule.test?.test?.('.svg')),
            {
                test: /\.svg$/,
                type: 'asset/resource',
                generator: {
                    filename: 'images/[name][ext]',
                },
            },
        ],
    },
    plugins: [
        ...defaultConfig.plugins,
        new CopyPlugin({
            patterns: [
                {
                    from: path.resolve(__dirname, 'src/images'),
                    to: path.resolve(__dirname, 'build/images'),
                },
            ],
        }),
    ],
};
