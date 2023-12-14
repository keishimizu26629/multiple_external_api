import express from 'express';
import fetch from 'node-fetch';
import bodyParser from 'body-parser';

const app = express();
app.use(bodyParser.json());

const callApi = async (url, data) => {
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' },
    });
    return response.json();
};

// GETリクエストのルートを追加
app.get('/', (req, res) => {
    res.send('Hello World');
});

app.post('/process', async (req, res) => {
    try {
        const id = req.body.id;

        // 1つ目のAPIを呼び出し
        const siteInfo = await callApi('http://localhost/api/get_site_info.php', { id });
        const siteName = siteInfo.name;

        // 2つ目のAPIを呼び出し
        const keyInfo = await callApi('http://localhost/api/get_key.php', { name: siteName });
        const key = keyInfo.key_value;

        // 3つ目のAPIを呼び出し
        const imageInfo = await callApi('http://localhost/api/get_image.php', { key });

        res.json(imageInfo);
    } catch (error) {
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
