const axios = require("axios");
const cheerio = require("cheerio");
const pretty = require("pretty");
const express = require('express');
const ws = require('ws');
const app = express();
var coin_data = array();


// const markup = `
// <ul class="fruits">
//   <li class="fruits__mango"> Mango </li>
//   <li class="fruits__apple"> Apple </li>
// </ul>
// `;

// const $ = cheerio.load(markup);
// console.log(pretty($.html()));

// const rp = require('request-promise');
// const url = 'https://kimpga.com/';

// rp(url)
//   .then(function(html){
//     //success!
//     console.log(html);
//   })
//   .catch(function(err){
//     //handle error
//   });

//바이낸스
/*
const client = new ws('wss://stream.binance.com:9443/ws/btcusdt@miniTicker/ethbtc@miniTicker/ethusdt@miniTicker/neobtc@miniTicker/neousdt@miniTicker/mtlbtc@miniTicker/mtlusdt@miniTicker/ltcbtc@miniTicker/ltcusdt@miniTicker/xrpbtc@miniTicker/xrpusdt@miniTicker/etcbtc@miniTicker/etcusdt@miniTicker/omgbtc@miniTicker/omgusdt@miniTicker/sntbtc@miniTicker/sntusdt@miniTicker/wavesbtc@miniTicker/wavesusdt@miniTicker/xembtc@miniTicker/xemusdt@miniTicker/qtumbtc@miniTicker/qtumusdt@miniTicker/lskbtc@miniTicker/lskusdt@miniTicker/steembtc@miniTicker/steemusdt@miniTicker/xlmbtc@miniTicker/xlmusdt@miniTicker/ardrbtc@miniTicker/ardrusdt@miniTicker/arkbtc@miniTicker/arkusdt@miniTicker/storjbtc@miniTicker/storjusdt@miniTicker/grsbtc@miniTicker/grsusdt@miniTicker/repbtc@miniTicker/repusdt@miniTicker/adabtc@miniTicker/adausdt@miniTicker/sbdbtc@miniTicker/sbdusdt@miniTicker/powrbtc@miniTicker/powrusdt@miniTicker/btgbtc@miniTicker/btgusdt@miniTicker/icxbtc@miniTicker/icxusdt@miniTicker/eosbtc@miniTicker/eosusdt@miniTicker/trxbtc@miniTicker/trxusdt@miniTicker/scbtc@miniTicker/scusdt@miniTicker/ontbtc@miniTicker/ontusdt@miniTicker/zilbtc@miniTicker/zilusdt@miniTicker/polybtc@miniTicker/polyusdt@miniTicker/zrxbtc@miniTicker/zrxusdt@miniTicker/loombtc@miniTicker/loomusdt@miniTicker/bchbtc@miniTicker/bchusdt@miniTicker/batbtc@miniTicker/batusdt@miniTicker/iostbtc@miniTicker/iostusdt@miniTicker/rfrbtc@miniTicker/rfrusdt@miniTicker/cvcbtc@miniTicker/cvcusdt@miniTicker/iqbtc@miniTicker/iqusdt@miniTicker/iotabtc@miniTicker/iotausdt@miniTicker/mftbtc@miniTicker/mftusdt@miniTicker/ongbtc@miniTicker/ongusdt@miniTicker/gasbtc@miniTicker/gasusdt@miniTicker/uppbtc@miniTicker/uppusdt@miniTicker/elfbtc@miniTicker/elfusdt@miniTicker/kncbtc@miniTicker/kncusdt@miniTicker/bsvbtc@miniTicker/bsvusdt@miniTicker/thetabtc@miniTicker/thetausdt@miniTicker/qkcbtc@miniTicker/qkcusdt@miniTicker/bttbtc@miniTicker/bttusdt@miniTicker/mocbtc@miniTicker/mocusdt@miniTicker/enjbtc@miniTicker/enjusdt@miniTicker/tfuelbtc@miniTicker/tfuelusdt@miniTicker/manabtc@miniTicker/manausdt@miniTicker/ankrbtc@miniTicker/ankrusdt@miniTicker/aergobtc@miniTicker/aergousdt@miniTicker/atombtc@miniTicker/atomusdt@miniTicker/ttbtc@miniTicker/ttusdt@miniTicker/crebtc@miniTicker/creusdt@miniTicker/mblbtc@miniTicker/mblusdt@miniTicker/waxpbtc@miniTicker/waxpusdt@miniTicker/hbarbtc@miniTicker/hbarusdt@miniTicker/medbtc@miniTicker/medusdt@miniTicker/mlkbtc@miniTicker/mlkusdt@miniTicker/stptbtc@miniTicker/stptusdt@miniTicker/orbsbtc@miniTicker/orbsusdt@miniTicker/vetbtc@miniTicker/vetusdt@miniTicker/chzbtc@miniTicker/chzusdt@miniTicker/stmxbtc@miniTicker/stmxusdt@miniTicker/dkabtc@miniTicker/dkausdt@miniTicker/hivebtc@miniTicker/hiveusdt@miniTicker/kavabtc@miniTicker/kavausdt@miniTicker/ahtbtc@miniTicker/ahtusdt@miniTicker/linkbtc@miniTicker/linkusdt@miniTicker/xtzbtc@miniTicker/xtzusdt@miniTicker/borabtc@miniTicker/borausdt@miniTicker/jstbtc@miniTicker/jstusdt@miniTicker/crobtc@miniTicker/crousdt@miniTicker/tonbtc@miniTicker/tonusdt@miniTicker/sxpbtc@miniTicker/sxpusdt@miniTicker/huntbtc@miniTicker/huntusdt@miniTicker/plabtc@miniTicker/plausdt@miniTicker/dotbtc@miniTicker/dotusdt@miniTicker/srmbtc@miniTicker/srmusdt@miniTicker/mvlbtc@miniTicker/mvlusdt@miniTicker/straxbtc@miniTicker/straxusdt@miniTicker/aqtbtc@miniTicker/aqtusdt@miniTicker/glmbtc@miniTicker/glmusdt@miniTicker/ssxbtc@miniTicker/ssxusdt@miniTicker/metabtc@miniTicker/metausdt@miniTicker/fct2btc@miniTicker/fct2usdt@miniTicker/cbkbtc@miniTicker/cbkusdt@miniTicker/sandbtc@miniTicker/sandusdt@miniTicker/humbtc@miniTicker/humusdt@miniTicker/dogebtc@miniTicker/dogeusdt@miniTicker/strkbtc@miniTicker/strkusdt@miniTicker/pundixbtc@miniTicker/pundixusdt@miniTicker/flowbtc@miniTicker/flowusdt@miniTicker/dawnbtc@miniTicker/dawnusdt@miniTicker/axsbtc@miniTicker/axsusdt@miniTicker/stxbtc@miniTicker/stxusdt@miniTicker/xecbtc@miniTicker/xecusdt@miniTicker/solbtc@miniTicker/solusdt@miniTicker/maticbtc@miniTicker/maticusdt@miniTicker/nubtc@miniTicker/nuusdt@miniTicker/aavebtc@miniTicker/aaveusdt@miniTicker/1inchbtc@miniTicker/1inchusdt@miniTicker/algobtc@miniTicker/algousdt@miniTicker/nearbtc@miniTicker/nearusdt@miniTicker/wemixbtc@miniTicker/wemixusdt@miniTicker/avaxbtc@miniTicker/avaxusdt@miniTicker/tbtc@miniTicker/tusdt@miniTicker/celobtc@miniTicker/celousdt@miniTicker/gmtbtc@miniTicker/gmtusdt@miniTicker');

// client.on('open', () => {
//   // Causes the server to print "Hello"
//   client.send('Hello');
// });

client.on('open', (res) => {
    // Causes the server to print "Hello"
    
  });

client.on('message', function(msg) {
    console.log(msg.toString())
//     var buf = new Uint8Array(msg).buffer;
// var dv = new DataView(buf);
// console.log(dv)
  });
*/
/*
const client = new ws('wss://stream.binance.com:9443/ws/btcusdt@miniTicker/ethbtc@miniTicker/ethusdt@miniTicker/neobtc@miniTicker/neousdt@miniTicker/mtlbtc@miniTicker/mtlusdt@miniTicker/ltcbtc@miniTicker/ltcusdt@miniTicker/xrpbtc@miniTicker/xrpusdt@miniTicker/etcbtc@miniTicker/etcusdt@miniTicker/omgbtc@miniTicker/omgusdt@miniTicker/sntbtc@miniTicker/sntusdt@miniTicker/wavesbtc@miniTicker/wavesusdt@miniTicker/xembtc@miniTicker/xemusdt@miniTicker/qtumbtc@miniTicker/qtumusdt@miniTicker/lskbtc@miniTicker/lskusdt@miniTicker/steembtc@miniTicker/steemusdt@miniTicker/xlmbtc@miniTicker/xlmusdt@miniTicker/ardrbtc@miniTicker/ardrusdt@miniTicker/arkbtc@miniTicker/arkusdt@miniTicker/storjbtc@miniTicker/storjusdt@miniTicker/grsbtc@miniTicker/grsusdt@miniTicker/repbtc@miniTicker/repusdt@miniTicker/adabtc@miniTicker/adausdt@miniTicker/sbdbtc@miniTicker/sbdusdt@miniTicker/powrbtc@miniTicker/powrusdt@miniTicker/btgbtc@miniTicker/btgusdt@miniTicker/icxbtc@miniTicker/icxusdt@miniTicker/eosbtc@miniTicker/eosusdt@miniTicker/trxbtc@miniTicker/trxusdt@miniTicker/scbtc@miniTicker/scusdt@miniTicker/ontbtc@miniTicker/ontusdt@miniTicker/zilbtc@miniTicker/zilusdt@miniTicker/polybtc@miniTicker/polyusdt@miniTicker/zrxbtc@miniTicker/zrxusdt@miniTicker/loombtc@miniTicker/loomusdt@miniTicker/bchbtc@miniTicker/bchusdt@miniTicker/batbtc@miniTicker/batusdt@miniTicker/iostbtc@miniTicker/iostusdt@miniTicker/rfrbtc@miniTicker/rfrusdt@miniTicker/cvcbtc@miniTicker/cvcusdt@miniTicker/iqbtc@miniTicker/iqusdt@miniTicker/iotabtc@miniTicker/iotausdt@miniTicker/mftbtc@miniTicker/mftusdt@miniTicker/ongbtc@miniTicker/ongusdt@miniTicker/gasbtc@miniTicker/gasusdt@miniTicker/uppbtc@miniTicker/uppusdt@miniTicker/elfbtc@miniTicker/elfusdt@miniTicker/kncbtc@miniTicker/kncusdt@miniTicker/bsvbtc@miniTicker/bsvusdt@miniTicker/thetabtc@miniTicker/thetausdt@miniTicker/qkcbtc@miniTicker/qkcusdt@miniTicker/bttbtc@miniTicker/bttusdt@miniTicker/mocbtc@miniTicker/mocusdt@miniTicker/enjbtc@miniTicker/enjusdt@miniTicker/tfuelbtc@miniTicker/tfuelusdt@miniTicker/manabtc@miniTicker/manausdt@miniTicker/ankrbtc@miniTicker/ankrusdt@miniTicker/aergobtc@miniTicker/aergousdt@miniTicker/atombtc@miniTicker/atomusdt@miniTicker/ttbtc@miniTicker/ttusdt@miniTicker/crebtc@miniTicker/creusdt@miniTicker/mblbtc@miniTicker/mblusdt@miniTicker/waxpbtc@miniTicker/waxpusdt@miniTicker/hbarbtc@miniTicker/hbarusdt@miniTicker/medbtc@miniTicker/medusdt@miniTicker/mlkbtc@miniTicker/mlkusdt@miniTicker/stptbtc@miniTicker/stptusdt@miniTicker/orbsbtc@miniTicker/orbsusdt@miniTicker/vetbtc@miniTicker/vetusdt@miniTicker/chzbtc@miniTicker/chzusdt@miniTicker/stmxbtc@miniTicker/stmxusdt@miniTicker/dkabtc@miniTicker/dkausdt@miniTicker/hivebtc@miniTicker/hiveusdt@miniTicker/kavabtc@miniTicker/kavausdt@miniTicker/ahtbtc@miniTicker/ahtusdt@miniTicker/linkbtc@miniTicker/linkusdt@miniTicker/xtzbtc@miniTicker/xtzusdt@miniTicker/borabtc@miniTicker/borausdt@miniTicker/jstbtc@miniTicker/jstusdt@miniTicker/crobtc@miniTicker/crousdt@miniTicker/tonbtc@miniTicker/tonusdt@miniTicker/sxpbtc@miniTicker/sxpusdt@miniTicker/huntbtc@miniTicker/huntusdt@miniTicker/plabtc@miniTicker/plausdt@miniTicker/dotbtc@miniTicker/dotusdt@miniTicker/srmbtc@miniTicker/srmusdt@miniTicker/mvlbtc@miniTicker/mvlusdt@miniTicker/straxbtc@miniTicker/straxusdt@miniTicker/aqtbtc@miniTicker/aqtusdt@miniTicker/glmbtc@miniTicker/glmusdt@miniTicker/ssxbtc@miniTicker/ssxusdt@miniTicker/metabtc@miniTicker/metausdt@miniTicker/fct2btc@miniTicker/fct2usdt@miniTicker/cbkbtc@miniTicker/cbkusdt@miniTicker/sandbtc@miniTicker/sandusdt@miniTicker/humbtc@miniTicker/humusdt@miniTicker/dogebtc@miniTicker/dogeusdt@miniTicker/strkbtc@miniTicker/strkusdt@miniTicker/pundixbtc@miniTicker/pundixusdt@miniTicker/flowbtc@miniTicker/flowusdt@miniTicker/dawnbtc@miniTicker/dawnusdt@miniTicker/axsbtc@miniTicker/axsusdt@miniTicker/stxbtc@miniTicker/stxusdt@miniTicker/xecbtc@miniTicker/xecusdt@miniTicker/solbtc@miniTicker/solusdt@miniTicker/maticbtc@miniTicker/maticusdt@miniTicker/nubtc@miniTicker/nuusdt@miniTicker/aavebtc@miniTicker/aaveusdt@miniTicker/1inchbtc@miniTicker/1inchusdt@miniTicker/algobtc@miniTicker/algousdt@miniTicker/nearbtc@miniTicker/nearusdt@miniTicker/wemixbtc@miniTicker/wemixusdt@miniTicker/avaxbtc@miniTicker/avaxusdt@miniTicker/tbtc@miniTicker/tusdt@miniTicker/celobtc@miniTicker/celousdt@miniTicker/gmtbtc@miniTicker/gmtusdt@miniTicker');

// client.on('open', () => {
//   // Causes the server to print "Hello"
//   client.send('Hello');
// });

client.on('open', (res) => {
    // Causes the server to print "Hello"
    
  });

client.on('message', function(msg) {
    console.log(msg.toString())
//     var buf = new Uint8Array(msg).buffer;
// var dv = new DataView(buf);
// console.log(dv)
  });
*/
//업비트
/*
const upbit_client = new ws('wss://api.upbit.com/websocket/v1');

// client.on('open', () => {
//   // Causes the server to print "Hello"
//   client.send('Hello');
// });

upbit_client.on('open', (res) => {
    // Causes the server to print "Hello"
    
  });

upbit_client.on('message', function(msg) {
    console.log(msg.toString())
//     var buf = new Uint8Array(msg).buffer;
// var dv = new DataView(buf);
// console.log(dv)
  });
  */
  const delay = ms => new Promise(res => setTimeout(res, ms));
  const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();

  await page.goto('https://kimpga.com/');
  await delay(5000);

  while (true){
    coin_data = await page.$$eval('#__next > div.max-w-screen-lg > div > div.mt-4.mb-8 > div:nth-child(7) > div > table > tbody > tr', rows => {
      return Array.from(rows, row => {
        const columns = row.querySelectorAll('td');
        var scrap_data = {};
        scrap_data.name_kor = columns[0].querySelector('div > div').textContent;
        scrap_data.name_eng = columns[0].querySelector('div > div:nth-child(2)').textContent;
        scrap_data.img_coin = columns[0].querySelector('div > div:nth-child(1) > img').src;
        
        var cur_price = columns[1].innerText.trim();
        var arr_cur_price = cur_price.split('\n');
        scrap_data.cur_price1 = arr_cur_price[0];
        scrap_data.cur_price1_1 = scrap_data.cur_price1.replace(',', '');
        scrap_data.cur_price2 = arr_cur_price.length > 1 ? arr_cur_price[1] : "";
        scrap_data.cur_price2_1 = scrap_data.cur_price2.replace(',', '');

        scrap_data.kimp_per = columns[2].querySelector('div:nth-child(1)').textContent;
        scrap_data.kimp_per_1 = scrap_data.kimp_per.replace('%', '');
        scrap_data.kimp_amt = columns[2].querySelector('div:nth-child(2)').textContent;
        scrap_data.kimp_amt_1 = scrap_data.kimp_amt.replace(',', '');

        var yesterday_info = columns[3].innerText.trim().replace('%', '');
        var arr_yesterday_info = yesterday_info.split('\n');
        scrap_data.comp_yesterday_per = arr_yesterday_info[0];
        scrap_data.comp_yesterday_amt = arr_yesterday_info[1];
        scrap_data.comp_yesterday_amt_1 = scrap_data.comp_yesterday_amt.replace(',', '');

        var highest_info = columns[4].innerText.trim();
        var arr_highest_info = highest_info.split('%');
        scrap_data.comp_highest_per = arr_highest_info[0];
        scrap_data.comp_highest_amt = arr_highest_info[1];
        scrap_data.comp_highest_amt_1 = scrap_data.comp_highest_amt.replace(',', '');

        var lowest_info = columns[5].innerText.trim();
        var arr_lowest_info = lowest_info.split('%');
        scrap_data.comp_lowest_per = arr_lowest_info[0];
        scrap_data.comp_lowest_amt = arr_lowest_info[1];
        scrap_data.comp_lowest_amt_1 = scrap_data.comp_lowest_amt.replace(',', '');

        var trade_info = columns[6].innerText.trim();
        var arr_trade_info = trade_info.split('\n');
        scrap_data.trade_amt1 = arr_trade_info[0];
        scrap_data.trade_amt1_1 = scrap_data.trade_amt1.replace(',', '').replace('조 ', '').replace('억', '00000000');
        scrap_data.trade_amt2 = arr_trade_info.length > 1 ? arr_trade_info[1] : "";
        scrap_data.trade_amt2_1 = scrap_data.trade_amt2.replace(',', '').replace('조 ', '').replace('억', '00000000');
        //if(scrap_data.name_eng == "WEMIX")
          return scrap_data;
      });
    });
    await(500);
  }
  browser.close();
})();

// Importing the required modules
const WebSocketServer = require('ws');
 
// Creating a new websocket server
const wss = new WebSocketServer.Server({ port: 8080 })
 
// Creating connection using websocket
wss.on("connection", ws => {
    console.log("new client connected");
    // sending message
    ws.on('message', function(message) {
        wss.broadcast(JSON.stringify(message));
        console.log('Received: ' + message);
      });
    // handling what to do when clients disconnects from server
    ws.on("close", () => {
        console.log("the client has connected");
    });
    // handling client connection error
    ws.onerror = function () {
        console.log("Some Error occurred")
    }

    ws.send('You successfully connected to the websocket.');

    
});

wss.broadcast = function broadcast(msg) {
  // console.log(msg);
  wss.clients.forEach(function each(client) {
      client.send(msg);
   });
};


setInterval(() => wss.broadcast(JSON.stringify(coin_data)), 1000);

console.log("The WebSocket server is running on port 8080");