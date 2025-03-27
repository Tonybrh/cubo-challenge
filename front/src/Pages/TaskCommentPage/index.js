import React, {useState, useEffect} from 'react';
import {useParams, useNavigate} from 'react-router-dom';
import api from '../../Utils/api';
import * as S from './style';

export default function TaskCommentsPage() {
    const {taskId} = useParams();
    const navigate = useNavigate();
    const [comments, setComments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showForm, setShowForm] = useState(false);
    const [newComment, setNewComment] = useState('');
    const [task, setTask] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const [taskResponse, commentsResponse] = await Promise.all([
                    api.get(`/task/${taskId}`),
                    api.get(`/comment/${taskId}`)
                ]);

                setTask(taskResponse.data);
                setComments(commentsResponse.data);
            } catch (error) {
                console.error('Failed to fetch data', error);
            } finally {
                setLoading(false);
            }
        };
        fetchData();
    }, [taskId]);

    const handleAddComment = async (e) => {
        e.preventDefault();
        if (!newComment.trim()) return;

        try {
            const response = await api.post(`/comment/create`, {
                content: newComment,
                task_id: taskId
            });
            setComments([...comments, response.data]);
            setNewComment('');
            setShowForm(false);
        } catch (error) {
            console.error('Failed to add comment', error);
        }
    };

    if (loading) {
        return <S.DashboardContainer>Carregando...</S.DashboardContainer>;
    }

    return (
        <S.DashboardContainer>
            <S.BackButton onClick={() => navigate('/dashboard')}>
                Voltar para Tasks
            </S.BackButton>

            <h2>Comentários da Task "{task.title}"</h2>

            {comments.length === 0 && !showForm ? (
                <S.NoCommentsMessage>
                    Nenhum comentário ainda.
                    <S.AddCommentButton onClick={() => setShowForm(true)}>
                        Adicionar Comentário
                    </S.AddCommentButton>
                </S.NoCommentsMessage>
            ) : (
                <S.CommentsList>
                    {comments.map(comment => (
                        <S.CommentItem key={comment.id}>
                            <S.CommentContent>{comment.content}</S.CommentContent>
                            <S.CommentMeta>
                                Em {new Date(comment.created_at).toLocaleDateString()}
                            </S.CommentMeta>
                        </S.CommentItem>
                    ))}
                </S.CommentsList>
            )}

            {showForm && (
                <S.CommentForm onSubmit={handleAddComment}>
                    <S.CommentTextArea
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                        placeholder="Digite seu comentário..."
                        required
                    />
                    <div style={{display: 'flex', gap: '1rem', marginTop: '1rem'}}>
                        <S.EditButton type="submit">
                            Adicionar Comentário
                        </S.EditButton>
                        <S.DeleteButton type="button" onClick={() => setShowForm(false)}>
                            Cancelar
                        </S.DeleteButton>
                    </div>
                </S.CommentForm>
            )}

            {!showForm && comments.length > 0 && (
                <S.AddCommentButton onClick={() => setShowForm(true)}>
                    Adicionar Novo Comentário
                </S.AddCommentButton>
            )}
        </S.DashboardContainer>
    );
};
