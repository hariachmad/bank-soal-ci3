const express = require("express");
const ExcelJS = require("exceljs");
const mysql = require("mysql2");
const router = express.Router();
const app = express();

const connection = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "ci4",
});

connection.connect((err) => {
	if (err) throw err;
	console.log("Terhubung ke MySQL!");
});

app.use(express.json());

app.use(express.urlencoded({ extended: true }));

app.post("/export-excel", async (req, res) => {
	try {
    const {id} = req.body;
		const workbook = new ExcelJS.Workbook();
		workbook.creator = "My Express App";
		workbook.created = new Date();

		const worksheet = workbook.addWorksheet("Data Report");

    worksheet.columns = [
			{ header: "NIM", key: "nim", width: 25 },
      { header: "Nama", key: "name", width: 30 },
			{ header: "Nilai", key: "nilai", width: 15 },
			{ header: "Tanggal", key: "tanggal", width: 10 },
		];

    connection.query(`SELECT users.fullname as name,users.id as NIM,user_nilai.nilai as nilai,user_nilai.created_at as tanggal FROM user_nilai LEFT JOIN users on user_nilai.id_users = users.id where user_nilai.id_ujian = "${id}"`, async (err, results) => {
    if (err) throw err;
    results.map((row)=>{
      worksheet.addRow([row.NIM,row.name,row.nilai,row.tanggal]);
    })

		res.setHeader(
			"Content-Type",
			"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
		);
		res.setHeader(
			"Content-Disposition",
			'attachment; filename="data_report.xlsx"'
		);

    await workbook.xlsx.write(res);
		res.end();


  });

		

    
	} catch (error) {
		console.error(error);
	}
});

const PORT = 4000;
app.listen(PORT, () => {
	console.log(`Server running on port ${PORT}`);
});

module.exports = router;
