<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 14:50
 */

namespace Ander\Dao;


use Ander\Battle;
use Ander\EstadoEncerrado;
use Ander\Jurado;

class BattleDao
{
    private $parser;

    /**
     * BattleDao constructor.
     */
    public function __construct()
    {
        $this->parser = new BattleFactory();
    }

    public function carregarBatalhaEmAndamento()
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        $result = $conn->query("SELECT battles.*, m1.nome as musica1,m1.votos as votos1, m2.nome as musica2,m2.votos as votos2 FROM battles JOIN musicas m1 ON battles.musica1_id = m1.id JOIN musicas m2 ON battles.musica2_id = m2.id WHERE battles.finalizado = false  ORDER BY battles.created_at ASC LIMIT 1;");
        $batalhas =  $this->parser->parseBattle($result);
        $conn->close();
        if(empty($batalhas))return null;
        return $batalhas[0];

    }

    public function carregarBatalhasNaoFinalizadas()
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        $result = $conn->query("SELECT battles.*, m1.nome as musica1,m1.votos as votos1, m2.nome as musica2,m2.votos as votos2 FROM battles  JOIN musicas m1 ON battles.musica1_id = m1.id JOIN musicas m2 ON battles.musica2_id = m2.id WHERE battles.finalizado = false;");
        $batalhas =  $this->parser->parseBattle($result);
        $conn->close();
        return $batalhas;
    }

    public function carregarBatalhasFinalizadas()
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        $result = $conn->query("SELECT battles.*, m1.nome as musica1,m1.votos as votos1, m2.nome as musica2,m2.votos as votos2 FROM battles  JOIN musicas m1 ON battles.musica1_id = m1.id JOIN musicas m2 ON battles.musica2_id = m2.id WHERE battles.finalizado = true;");
        $batalhas =  $this->parser->parseBattle($result);
        $conn->close();
        return $batalhas;
    }

    public function carregarTodasBatalhas()
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        $result = $conn->query("SELECT battles.*, m1.nome as musica1,m1.votos as votos1, m2.nome as musica2,m2.votos as votos2 FROM battles JOIN musicas m1 ON battles.musica1_id = m1.id JOIN musicas m2 ON battles.musica2_id = m2.id");
        $batalhas =  $this->parser->parseBattle($result);
        $conn->close();
        return $batalhas;
    }



    public function adicionarBatalha(Battle $battle)
    {
        $conn = ConnectionFactory::getInstance()->getConnection();
        $stmt = $conn->prepare("INSERT INTO musicas (nome) values (?),(?)");
        $stmt->bind_param("ss", $nome1, $nome2);

        $nome1 = $battle->getMusica1()->getNome();
        $nome2 = $battle->getMusica2()->getNome();

        $stmt->execute();
        $id = $stmt->insert_id;
        $id2 = $id+1;
        $stmt->close();

        $conn->query("INSERT INTO battles (musica1_id, musica2_id) values ({$id},{$id2})");
        $conn->close();


    }
    public function encerrarBatalha(Battle $battle){
        $conn = ConnectionFactory::getInstance()->getConnection();
        $conn->query("UPDATE TABLE battles SET finalizado = 1 WHERE id= {$battle->getId()}");

    }
    public function instalarBatalhasDao()
    {
        $sql = "DROP TABLE IF EXISTS battles, musicas";
        $sql2 = "CREATE TABLE battles (ID INT AUTO_INCREMENT PRIMARY KEY, musica1_id INTEGER , musica2_id INTEGER, created_at TIMESTAMP DEFAULT NOW(), finalizado BOOL DEFAULT FALSE)";
        $sql3 = "CREATE TABLE musicas (ID INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(255) , votos INTEGER DEFAULT 0 )";

        $conn = ConnectionFactory::getInstance()->getConnection();

        $conn->query($sql);
        $conn->query($sql2);
        $conn->query($sql3);

        $conn->close();

    }
}