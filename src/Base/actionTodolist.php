<?php


namespace Base;


class actionTodolist extends DataBase
{
    public function selectList()
    {

        $response = $this->query('SELECT * FROM list order by id DESC ');
        return $response->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function addList()
    {

        $id = $_SESSION['id'];
        $nom = $_POST['tache'];
        $time = time();
        $this->query('INSERT INTO list (`id_utilisateurs`, `nom`, `date_creation`, `date_fin`, `checked`) VALUES (?,?,?,?,?)', [
            $id,
            $nom,
            $time,
            0,
            0,
        ]);
        $insert = $this->query('SELECT * FROM list WHERE id = ? ', [$this->lastInsertId()]);
        $insert = $insert->fetch(\PDO::FETCH_ASSOC);
        $dataTime = new \DateTime();
        $dataTime->setTimestamp($insert['date_creation']);
        return [
            'list' => [
                'id' => $insert['id'],
                'nom' => $insert['nom'],
                'date' => $dataTime->format('d/m/Y H:i')
            ]
        ];


    }
}