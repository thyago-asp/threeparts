<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
/**
 * Description of Usuario
 *
 * @author Thyago
 */
class Usuario
{
    //put your code here
    private $id_usuario;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    private $perfil;


    function getEmail()
    {
        return $this->email;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getPerfil()
    {
        return $this->perfil;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }


    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    /**
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }


    function realizarLogin(Usuario $u)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT idt_usuarios, nome, perfil, count(*) as conectado, primeiro_acesso FROM t_usuarios WHERE email=:p_login AND senha=:p_senha";

        $stmt = $con->prepare($query);
        $stmt->bindValue(':p_login', $u->getEmail());
        $stmt->bindValue(':p_senha', $u->getSenha());

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function cadastrarUsuario(Usuario $usuario)
    {
        $con = Conexao::abrirConexao();
        try {
            $query = "INSERT INTO t_usuarios (nome, email, senha, perfil, primeiro_acesso) 
                 VALUES(:nome, :email, :senha, :perfil, :primeiro_acesso)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->bindValue(':perfil', $usuario->getPerfil());
            $stmt->bindValue(':primeiro_acesso', 1);

            return $stmt->execute();
        } catch (Exception $e) {

            return $e->getCode();
        }
    }

    public function listarUsuarios()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_usuarios";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function alterar(Usuario $usuario)
    {

        $con = Conexao::abrirConexao();

        $query = "UPDATE t_usuarios
        SET nome= :nome, perfil = :perfil
        WHERE idt_usuarios = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':perfil', $usuario->getPerfil());

        $stmt->bindValue(':id', $usuario->getId_usuario());
        $result = $stmt->execute();

        return $result;
    }

    public function resetarSenha($idusuario)
    {
        $con = Conexao::abrirConexao();

        $query = "UPDATE t_usuarios
        SET senha = :senha, primeiro_acesso = :primeiro_acesso
        WHERE idt_usuarios = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':senha', md5("123456"));
        $stmt->bindValue(':primeiro_acesso', "1");

        $stmt->bindValue(':id', $idusuario);
        $result = $stmt->execute();

        return $result;
    }

    public function alterarSenha(Usuario $usuario)
    {
        $con = Conexao::abrirConexao();

        $query = "UPDATE t_usuarios
        SET senha = :senha, primeiro_acesso = :primeiro_acesso
        WHERE idt_usuarios = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':primeiro_acesso', "0");

        $stmt->bindValue(':id', $usuario->getId_usuario());
        $result = $stmt->execute();

        return $result;
    }


    public function excluirUsuario(Usuario $usuario)
    {
        try {
            $con = Conexao::abrirConexao();

            $sql = "DELETE FROM t_usuarios WHERE idt_usuarios=:id";
            $stmt = $con->prepare($sql);

            $stmt->bindValue(':id', $usuario->getId_usuario());

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
